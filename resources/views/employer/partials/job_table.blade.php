<tbody>
  @foreach($applications as $job)
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
  @endforeach
  @if($applications->isEmpty())
    <tr><td colspan="10" class="text-center py-4">No jobs found.</td></tr>
  @endif
</tbody>
