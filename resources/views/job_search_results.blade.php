
@foreach($jobs as $job)
<div>
    <hr>
    <br>
    <h3>{{$job->company}}</h3>

    <h2>{{$job->title}}
        <span>{{$job->job_rating}}</span>
    </h2>

    <h4>{{$job->location}}</h4>

    <p>{{$job->description}}</p>
</div>
@endforeach
