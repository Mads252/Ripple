<form class="formContainer" action="index.php?action=addPost" method="post" enctype="multipart/form-data">
    <h2>Add post</h2>
    <div class="textContentContainer">
        <label class="labels" for="textContentInput">Subject</label>
        <textarea class="textArea" id="textContentInput" name="data[textContent]" placeholder="Write something.." rows="10"></textarea>
    </div>
    
    <div>
        <label class="labels" for="postImage">Post an image</label>
        <input type="file" id="postImage" name="data[postImage]">
    </div>

    <button type="submit" class="submitBtn">Add post</button>
</form>
