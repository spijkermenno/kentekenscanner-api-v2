<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unvalidated Images</title>
    <style>
        /* Add some basic styling for better presentation */
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Unvalidated Images</h1>

@foreach ($unvalidatedImages as $image)
    <div>
        <img src="{{ asset($image->path) }}" alt="Image">
        <br>
        <button onclick="approveImage({{ $image->id }})">Approve</button>
        <button onclick="deleteImage({{ $image->id }})">Delete</button>
        <hr>
    </div>
@endforeach

<script>
    function approveImage(imageId) {
        // Implement your logic to approve the image using AJAX
        fetch(`/validate-image/${imageId}`, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            // Refresh the page on completion
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    }

    function deleteImage(imageId) {
        // Implement your logic to delete the image using AJAX
        fetch(`/delete-image/${imageId}`, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            // Refresh the page on completion
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>
