@extends('admin.layout.layout')
@section('content')
<style>
    .editor-container {
      max-width: 800px;
      margin: auto;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 20px;
      position: relative;
    }
    .toolbar {
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
      margin-bottom: 15px;
      background: #fff;
      z-index: 99;
    }
    .toolbar button, .toolbar select {
      background: none;
      border: none;
      font-size: 16px;
      margin-right: 10px;
      cursor: pointer;
    }
    .toolbar button:hover {
      color: #007BFF;
    }
    .editor, .html-editor {
      min-height: 300px;
      outline: none;
      position: relative;
      background-color: #f9f9f9;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
      overflow-y: auto;
      margin-top: 60px;
    }
    input[type="file"] {
      display: none;
    }
    .toolbar label {
      cursor: pointer;
    }
    .resizable {
      position: relative;
      display: inline-block;
      max-width: 100%;
    }
    .resizable img {
      max-width: 100%;
      height: auto;
    }
    .resizable .resize-handle {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 15px;
      height: 15px;
      background: #007bff;
      cursor: se-resize;
    }
    .delete-btn {
      position: absolute;
      top: 5px;
      right: 5px;
      background: #ff4d4d;
      color: white;
      border: none;
      padding: 5px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 16px;
    }
    ul {
      margin-left: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    table, th, td {
      border: 2px solid black;
    }
    th, td {
      padding: 10px;
      text-align: left;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><small>Create Blog</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="blogForm" method="POST" action="{{ route('admin.blogs.store2') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="blogImage">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="blogImage">
                                            <label class="custom-file-label" for="blogImage">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="imagealt">Image Alt</label>
                                  <input type="text" name="alt" class="form-control @error('alt') is-invalid @enderror" id="imagealt" placeholder="Image Alt" value="{{ old('alt') }}">
                                  @error('alt')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                                <div class="form-group">
                                    <label for="ArticleAuthor">Article Author</label>
                                    <input type="text" name="article_author" class="form-control @error('article_author') is-invalid @enderror" id="article_author" placeholder="Enter Blog Article Author" value="{{ old('article_author') }}">
                                    @error('article_author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogTitle">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="blogTitle" placeholder="Enter Blog Title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogTitle">Tagename</label>
                                    <input type="text" name="tagename" class="form-control @error('tagename') is-invalid @enderror" id="tagename" placeholder="Enter Blog Tagename" value="{{ old('tagename') }}">
                                    @error('tagename')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogDescription">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="blogDescription" placeholder="Enter Blog Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="editormain-container">
                                        <div class="toolbar">
                                          <button type="button" onclick="execCmd('bold')"><b>B</b></button>
                                          <button type="button" onclick="execCmd('italic')"><i>I</i></button>
                                          <button  type="button"onclick="execCmd('underline')"><u>U</u></button>
                                          <button  type="button"onclick="execCmd('insertUnorderedList')">• List</button>
                                          <button type="button" onclick="execCmd('formatBlock', 'H1')">H1</button>
                                          <button type="button" onclick="execCmd('formatBlock', 'H2')">H2</button>
                                          <button type="button" onclick="execCmd('formatBlock', 'H3')">H3</button>
                                          <button type="button" onclick="execCmd('formatBlock', 'H4')">H4</button>
                                          <button type="button" onclick="execCmd('formatBlock', 'H5')">H5</button>
                                          <button  type="button" onclick="createLink()">🔗</button>
                                          
                                          <!-- Dropdown to change list type -->
                                          <select id="listType" onchange="changeListType()">
                                            <option value="disc">• Bullet</option>
                                            <option value="decimal">1. Number</option>
                                            <option value="upper-roman">I. Roman (Upper)</option>
                                            <option value="lower-roman">i. Roman (Lower)</option>
                                            <option value="lower-alpha">a. Lowercase Letter</option>
                                          </select>
                                    
                                          <label title="Add Image">
                                            🖼️ <input type="file" accept="image/*" onchange="insertImage(event)">
                                          </label>
                                    
                                          <!-- Button to insert a table -->
                                          <button type="button" onclick="insertTable()">Insert Table</button>
                                    
                                          <!-- Toggle between Visual and HTML mode -->
                                          <button type="button" onclick="toggleMode()">HTML Mode</button>
                                        </div>
                                    
                                        <!-- Visual Mode (default) -->
                                        <div id="editormain" class="editor" contenteditable="true" onkeyup="storedataincontent()" onblur="storedataincontent()" >
                                         @php
                                         $yourString= old('content_html');
                                         @endphp
                                          {!! html_entity_decode($yourString) !!}
                                        </div>
                                        <textarea id="htmleditorcontent" class="html-editormain" name="content_html" style="display: none;"> {!! html_entity_decode($yourString) !!}</textarea>
                                        <textarea id="htmleditormain" class="html-editormain" style="display: none;" oninput="updatePreview()"> {!! html_entity_decode($yourString) !!}</textarea>
                                          </div>
                                    @error('content_html')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                                {{-- <div class="form-group">
                                    <label for="seo_meta_tag_title">SEO Meta Tag Title</label>
                                    <input type="text" name="seo_meta_tag_title" class="form-control @error('seo_meta_tag_title') is-invalid @enderror" id="seo_meta_tag_title" placeholder="Enter Page Name" value="{{ old('seo_meta_tag_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="seo_meta_tag">SEO Meta Tag Description</label>
                                    <input type="text" name="seo_meta_tag" class="form-control @error('seo_meta_tag') is-invalid @enderror" id="seo_meta_tag" placeholder="Enter Page Name" value="{{ old('seo_meta_tag') }}">
                                </div> --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Include CKEditor script -->
<!-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> -->
<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     CKEDITOR.replace('blogContentHtml', {
    //          allowedContent: true, // Allow all content including inline styles
    //          extraAllowedContent: '*(*);*{*}', // Allow all tags and all styles
    //          removeFormatAttributes: ''
    //         });
    // });
</script>
<script>
    let isHtmlMode = false;

    function execCmd(command, value = null) {
      document.execCommand(command, false, value);
    }

    function createLink() {
      const url = prompt("Enter the URL");
      if (url) {
        execCmd("createLink", url);
      }
    }

    function insertImage(event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function(e) {
        const img = document.createElement("img");
        img.src = e.target.result;
        img.style.maxWidth = "100%";
        img.style.margin = "10px 0";

        const resizableContainer = document.createElement("div");
        resizableContainer.classList.add("resizable");
        resizableContainer.appendChild(img);

        const resizeHandle = document.createElement("div");
        resizeHandle.classList.add("resize-handle");
        resizableContainer.appendChild(resizeHandle);

        // Create delete button
        const deleteBtn = document.createElement("button");
        deleteBtn.classList.add("delete-btn");
        deleteBtn.innerHTML = "X";
        deleteBtn.onclick = () => resizableContainer.remove();
        resizableContainer.appendChild(deleteBtn);

        document.getElementById("editormain").appendChild(resizableContainer);

        // Add event listener for resizing
        makeImageResizable(resizableContainer, resizeHandle);
      };
      reader.readAsDataURL(file);
    }

    function makeImageResizable(resizableContainer, resizeHandle) {
      let isResizing = false;
      let lastX = 0;
      let lastY = 0;

      resizeHandle.addEventListener('mousedown', function(e) {
        e.preventDefault();
        isResizing = true;
        lastX = e.clientX;
        lastY = e.clientY;

        window.addEventListener('mousemove', onMouseMove);
        window.addEventListener('mouseup', onMouseUp);
      });

      function onMouseMove(e) {
        if (!isResizing) return;
        
        const dx = e.clientX - lastX;
        const dy = e.clientY - lastY;
        
        const newWidth = resizableContainer.offsetWidth + dx;
        const newHeight = resizableContainer.offsetHeight + dy;

        if (newWidth > 50 && newHeight > 50) {
          resizableContainer.style.width = newWidth + "px";
          resizableContainer.style.height = newHeight + "px";
        }

        lastX = e.clientX;
        lastY = e.clientY;
      }

      function onMouseUp() {
        isResizing = false;
        window.removeEventListener('mousemove', onMouseMove);
        window.removeEventListener('mouseup', onMouseUp);
      }
    }

    // Function to change list type (e.g., number, roman, etc.)
    function changeListType() {
      const listType = document.getElementById("listType").value;
      const selection = window.getSelection();
      const range = selection.getRangeAt(0);
      
      // Check if already inside an unordered list
      if (range.startContainer.nodeName !== "LI" && !range.startContainer.closest('ul')) {
        // Create a new unordered list if not inside one
        const ul = document.createElement('ul');
        ul.style.listStyleType = listType; // Change the list type
        const li = document.createElement('li');
        li.textContent = 'New list item';
        ul.appendChild(li);
        document.getElementById('editormain').appendChild(ul);
      } else {
        const ul = range.startContainer.closest('ul');
        ul.style.listStyleType = listType; // Change the list type for existing list
      }
    }

    // Insert a table
    function insertTable() {
    const rows = prompt("Enter the number of rows:");
    const cols = prompt("Enter the number of columns:");
    let borderColor = prompt("Enter border color (e.g. red, blue, #333):", "black");

    if (rows && cols) {
        if (!borderColor) borderColor = "black";

        const wrapper = document.createElement("div");
        wrapper.style.position = "relative";
        wrapper.style.marginTop = "10px";
        wrapper.style.display = "inline-block";

        const table = document.createElement("table");
        table.style.border = `2px solid ${borderColor}`;
        table.style.borderCollapse = "collapse";
        table.style.margin = "10px 0";

        for (let i = 0; i < rows; i++) {
            const tr = document.createElement("tr");
            for (let j = 0; j < cols; j++) {
                const td = document.createElement("td");
                td.textContent = `Cell ${i + 1},${j + 1}`;
                td.style.border = `2px solid ${borderColor}`;
                td.style.padding = "8px";
                tr.appendChild(td);
            }
            table.appendChild(tr);
        }

        // Add a heading row to the table
        const headingRow = document.createElement("tr");
        for (let j = 0; j < cols; j++) {
            const th = document.createElement("th");
            th.textContent = `Heading ${j + 1}`;
            th.style.border = `2px solid ${borderColor}`;
            th.style.padding = "8px";
            headingRow.appendChild(th);
        }
        table.insertBefore(headingRow, table.firstChild);

        // Create a delete button
        const deleteBtn = document.createElement("button");
        deleteBtn.textContent = "X";
        deleteBtn.style.position = "absolute";
        deleteBtn.style.top = "-10px";
        deleteBtn.style.right = "-10px";
        deleteBtn.style.background = "#ff4d4d";
        deleteBtn.style.color = "white";
        deleteBtn.style.border = "none";
        deleteBtn.style.borderRadius = "50%";
        deleteBtn.style.width = "25px";
        deleteBtn.style.height = "25px";
        deleteBtn.style.cursor = "pointer";
        deleteBtn.style.zIndex = "10";
        deleteBtn.onclick = () => wrapper.remove();

        // Create a drag handle
        const dragHandle = document.createElement("button");
        dragHandle.textContent = "⇔"; // Drag icon
        dragHandle.style.position = "absolute";
        dragHandle.type='button';
        dragHandle.style.left = "-20px";
        dragHandle.style.top = "50%";
        dragHandle.style.transform = "translateY(-50%)";
        dragHandle.style.cursor = "ew-resize";
        dragHandle.style.background = "#007bff";
        dragHandle.style.color = "white";
        dragHandle.style.border = "none";
        dragHandle.style.borderRadius = "50%";
        dragHandle.style.width = "25px";
        dragHandle.style.height = "25px";
        dragHandle.style.zIndex = "10";

        // Add drag functionality to the handle
        let isDragging = false;
        let startX = 0;
        let startMargin = 0;

        dragHandle.addEventListener("mousedown", function (e) {
            e.preventDefault();
            isDragging = true;
            startX = e.clientX;
            startMargin = parseInt(wrapper.style.marginLeft, 10) || 0;

            document.addEventListener("mousemove", onMouseMove);
            document.addEventListener("mouseup", onMouseUp);
        });

        function onMouseMove(e) {
            if (!isDragging) return;

            const dx = e.clientX - startX;
            wrapper.style.marginLeft = `${startMargin + dx}px`;
        }

        function onMouseUp() {
            isDragging = false;
            document.removeEventListener("mousemove", onMouseMove);
            document.removeEventListener("mouseup", onMouseUp);
        }

        // Append the drag handle and delete button to the wrapper
        wrapper.appendChild(dragHandle);
        wrapper.appendChild(deleteBtn);
        wrapper.appendChild(table);

        // Append the wrapper to the editor
        document.getElementById("editormain").appendChild(wrapper);
    }
}
// Add option for <p> tag in toolbar
const pButton = document.createElement("button");
pButton.type = "button";
pButton.textContent = "P";
pButton.onclick = () => execCmd("formatBlock", "P");
document.querySelector(".toolbar").appendChild(pButton);

// Toggle between HTML mode and Visual mode
    function toggleMode() {
      const editormain = document.getElementById('editormain');
      const htmleditormain = document.getElementById('htmleditormain');

      if (isHtmlMode) {
        // Switch to visual mode
        htmleditormain.style.display = 'none';
        editormain.style.display = 'block';
        editormain.innerHTML = htmleditormain.value;  // Update the visual editormain with the HTML content
        this.textContent = 'HTML Mode';
      } else {
        // Switch to HTML mode
        editormain.style.display = 'none';
        htmleditormain.style.display = 'block';
        htmleditormain.value = editormain.innerHTML;  // Transfer the HTML content to HTML editormain
        this.textContent = 'Visual Mode';
      }

      isHtmlMode = !isHtmlMode;
    }


    function storedataincontent() {
    const editormain = document.getElementById('editormain');
    const htmleditormain = document.getElementById('htmleditorcontent');
    console.log(editormain.innerHTML);

    // Clone the content of the editor
    const clonedContent = editormain.cloneNode(true);

    // Remove all button elements from the cloned content
    const buttons = clonedContent.querySelectorAll('button');
    buttons.forEach(button => button.remove());

    // Remove the 'contenteditable' attribute from all elements
    const editableElements = clonedContent.querySelectorAll('[contenteditable]');
    editableElements.forEach(element => element.removeAttribute('contenteditable'));

    // Store the cleaned HTML content in the hidden textarea
    htmleditormain.innerHTML = clonedContent.innerHTML;
}
// Function to dynamically add a nested list on double-click
document.addEventListener("DOMContentLoaded", function () {
    const editormain = document.getElementById("editormain");

    // Add a double-click event listener to the editor
    editormain.addEventListener("dblclick", function (event) {
        const target = event.target;

        // Check if the double-clicked element is a list item (LI)
        if (target.tagName === "LI"|| target.closest("li")) {
            // Create a new unordered list (nested list)
            const nestedUl = document.createElement("ul");
            const newLi = document.createElement("li");
            newLi.textContent = "New nested item"; // Default text for the new list item
            nestedUl.appendChild(newLi);

            // Append the nested list to the clicked list item
            target.appendChild(nestedUl);
        }
    });
});
// Function to dynamically handle double-click on a table
// Function to dynamically handle double-click on a table
document.addEventListener("DOMContentLoaded", function () {
    const editormain = document.getElementById("editormain");

    // Add a double-click event listener to the editor
    editormain.addEventListener("dblclick", function (event) {
        const target = event.target;

        // Check if the double-clicked element is a table
        if (target.tagName === "TABLE" || target.closest("table") || target.tagName==='IMG' || target.closest("img")) {
            const table = target.closest("table");

            // Create a new div
            const newDiv = document.createElement("div");
            newDiv.style.marginTop = "10px";

            // Create a new paragraph inside the div
            const newParagraph = document.createElement("p");
            newParagraph.textContent = "Enter your content here..."; // Default text
            newParagraph.contentEditable = "true"; // Make it editable

            // Append the paragraph to the new div
            newDiv.appendChild(newParagraph);
            const editormain = document.getElementById('editormain');
            // Append the new div to the editor
            editormain.appendChild(newDiv);
            // Insert the new div after the table
            // table.insertAdjacentElement("afterend", newDiv);

            // Focus on the new paragraph
            const range = document.createRange();
            const selection = window.getSelection();
            range.selectNodeContents(newParagraph);
            range.collapse(false);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    });
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("#editormain"); // Change to your actual field ID

    if (input) {
      input.addEventListener("paste", function (e) {
        e.preventDefault();

        // Get clipboard data
            const clipboard = e.clipboardData || window.clipboardData;
            const htmlData = clipboard.getData("text/html") || clipboard.getData("text/plain");

            // Parse pasted HTML
            const temp = document.createElement("div");
            temp.innerHTML = htmlData;

            // Keep only <span> tags
            const clean = [];
            temp.querySelectorAll("*").forEach(node => {
                if (node.tagName.toLowerCase() === "span") {
                    const span = document.createElement("span");
                    span.textContent = node.textContent;
                    clean.push(span.outerHTML);
                } else {
                    clean.push(node.textContent); // Preserve text without tags
                }
            });
            // Insert plain text without any tags
            document.execCommand("insertText", false, temp.textContent);
            // // Insert cleaned HTML
            // document.execCommand("insertHTML", false, clean.join(""));
        });
    }
});
</script>

@endsection
