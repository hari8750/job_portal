{{-- resources/views/employer/applications.blade.php --}}
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Applications — Employer</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Small custom styles for a cleaner corporate look */
    body { background: #f5f7fb; }
    .card-hero { background: linear-gradient(90deg,#2b6cb0 0%, #285e8e 100%); color:#fff; border-radius:12px;}
    .table thead th { background: #eef2f7; border-bottom: 2px solid #e0e6ef; }
    .status-badge.applied { background:#f6ad55; color:#7a3b00; }
    .status-badge.shortlisted { background:#68d391; color:#064e3b; }
    .status-badge.hired { background:#34d399; color:#064e3b; }
    .status-badge.rejected { background:#f87171; color:#7f1d1d; }
    .search-input { max-width:520px; }
    .job-chip { font-size: .85rem; background:#eef6ff; color:#0b3d91; padding:.25rem .5rem; border-radius:10px; }
  </style>
</head>
<body>
<div class="container py-4">

  <!-- Header card -->
  <div class="card card-hero p-4 mb-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h3 class="mb-0">Manage Applications</h3>
        <div class="small opacity-85">Review applications submitted by candidates to your job posts.</div>
      </div>
      <div>
        <a href="{{ route('employer.post_job') }}" class="btn btn-light btn-sm">Post a Job</a>
        <a href="{{ route('employer.profile') }}" class="btn btn-outline-light btn-sm">Edit Profile</a>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex gap-2">
      <input id="searchInput" class="form-control form-control-sm search-input" type="text" placeholder="Search candidate, phone, city or job...">
      <select id="filterStatus" class="form-select form-select-sm">
        <option value="">All status</option>
        <option value="applied">Applied</option>
        <option value="shortlisted">Shortlisted</option>
        <option value="hired">Hired</option>
        <option value="rejected">Rejected</option>
      </select>
    </div>

    <div class="text-muted small">Total applications: <strong id="totalCount">{{ $applications->count() }}</strong></div>
  </div>

  <!-- Filter buttons updated -->
  <div class="d-flex gap-2 mb-3">
    <a href="{{ route('employer.dashboard') }}" class="btn btn-secondary btn-sm {{ request()->status == null ? 'active' : '' }}">All Jobs</a>
    <a href="{{ route('employer.dashboard', ['status' => 'active']) }}" class="btn btn-success btn-sm {{ request()->status == 'active' ? 'active' : '' }}">Active</a>
    <a href="{{ route('employer.dashboard', ['status' => 'under_review']) }}" class="btn btn-warning btn-sm {{ request()->status == 'under_review' ? 'active' : '' }}">Under Review</a>
    <a href="{{ route('employer.dashboard', ['status' => 'expired']) }}" class="btn btn-danger btn-sm {{ request()->status == 'expired' ? 'active' : '' }}">Expired</a>
  </div>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <div class="table-responsive" id="job-table-container">
      <table class="table align-middle mb-0" id="jobTable">
        <thead class="small">
          <tr>
            <th>ID</th>
            <th>Employer ID</th>
            <th>Title</th>
            <th>Company</th>
            <th>Location</th>
            <th>Salary</th>
            <th>Description</th>
            <th>Posted On</th>
            <th>Applications</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($applications as $job)
          <tr>
            <td>{{ $job->id }}</td>
            <td>{{ $job->employer_id ?? 'N/A' }}</td>
            <td>{{ $job->title ?? 'N/A' }}</td>
            <td>{{ $job->company ?? 'N/A' }}</td>
            <td>{{ $job->location ?? 'N/A' }}</td>
            <td>{{ $job->salary ?? 'N/A' }}</td>
            <td>{{ Str::limit($job->description, 50) ?? 'N/A' }}</td>
            <td>{{ $job->created_at ? $job->created_at->format('d M, Y') : '' }}</td>
            <td>
              {{ $job->applications_count }}
              @if($job->applications_count > 0)
              <a href="{{ route('employer.appliedCandidates', $job->id) }}" class="btn btn-sm btn-primary ms-2">
                Applied
              </a>
              @endif
            </td>
            <td>
              <a href="{{ route('jobs.duplicate', $job->id) }}" class="btn btn-sm btn-secondary">Duplicate</a>
              <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <a href="{{ route('jobs.repost', $job->id) }}" class="btn btn-sm btn-info">Repost</a>
              <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"
                  onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="10" class="text-center py-4">No jobs found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
{{-- Pagination space (if you change to paginate) --}}
{{-- <div class="mt-3">{{ $applications->links() }}</div> --}}

</div>

  {{-- Pagination space (if you change to paginate) --}}
  {{-- <div class="mt-3">{{ $applications->links() }}</div> --}}

</div>

<!-- Details Modal -->
<div class="modal fade" id="appModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Application Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <dl class="row">
          <dt class="col-sm-3">Candidate</dt><dd class="col-sm-9" id="modalName"></dd>
          <dt class="col-sm-3">Phone</dt><dd class="col-sm-9" id="modalPhone"></dd>
          <dt class="col-sm-3">City</dt><dd class="col-sm-9" id="modalCity"></dd>
          <dt class="col-sm-3">Job</dt><dd class="col-sm-9" id="modalJob"></dd>
          <dt class="col-sm-3">Status</dt><dd class="col-sm-9" id="modalStatus"></dd>
          <dt class="col-sm-3">Applied At</dt><dd class="col-sm-9" id="modalCreated"></dd>
        </dl>
      </div>
      <div class="modal-footer">
        <form id="statusForm" method="POST" style="display:inline;">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="formId">
          <button type="submit" class="btn btn-success">Mark Shortlisted</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS + small script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (function(){
    const rows = Array.from(document.querySelectorAll('#appsTable tbody tr')).filter(r => r.dataset.id);
    const searchInput = document.getElementById('searchInput');
    const filterStatus = document.getElementById('filterStatus');
    const totalCount = document.getElementById('totalCount');

    function filterTable() {
      const q = (searchInput.value || '').trim().toLowerCase();
      const status = filterStatus.value;
      let visible = 0;
      rows.forEach(r => {
        const matchesQuery = !q || (
          r.dataset.name.includes(q) ||
          r.dataset.phone.includes(q) ||
          r.dataset.city.includes(q) ||
          r.dataset.job.includes(q)
        );
        const matchesStatus = !status || r.dataset.status === status;
        if (matchesQuery && matchesStatus) {
          r.style.display = '';
          visible++;
        } else {
          r.style.display = 'none';
        }
      });
      totalCount.innerText = visible;
    }

    searchInput.addEventListener('input', filterTable);
    filterStatus.addEventListener('change
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- AJAX Filtering Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.filter-btn').click(function(e){
    e.preventDefault();
    var status = $(this).data('status');

    $.ajax({
      url: "{{ route('employer.dashboard') }}",
      type: "GET",
      data: { status: status },
      success: function(data){
        $('#job-table-container').html(data); // replace table content
        $('.filter-btn').removeClass('active');
        $('[data-status="'+status+'"]').addClass('active');
        history.replaceState(null, '', '?status=' + status); // update URL
      },
      error: function(){
        alert('Something went wrong!');
      }
    });
  });
});
</script>
