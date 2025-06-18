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
      max-height: 450px;
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
     .dropdown-container {
            position: relative;
          
            font-family: Arial, sans-serif;
            
        }
        .search-input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .dropdown-wrapper {
            position: relative;
        }
        .dropdown-arrow {
            position: absolute;
            right: 10px;
            top: 12px;
            cursor: pointer;
            color: #666;
            font-size: 12px;
            pointer-events: none;
        }
        .dropdown-list {
            display: none;
            position: absolute;
            width: 100%;
            max-height: 250px;
            overflow-y: auto;
            border: 1px solid #ddd;
            background: white;
            z-index: 1000;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 5px;
        }
        .dropdown-item {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
        }
        .dropdown-item:hover {
            background-color: #f8f8f8;
        }
        .dropdown-item .product-name {
            font-weight: 500;
        }
        .dropdown-item .category {
            font-size: 12px;
            color: #666;
            margin-top: 3px;
        }
        .selected-items {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }
        .selected-tag {
            background: #e0e0e0;
            padding: 5px 10px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            font-size: 13px;
        }
        .remove-btn {
            margin-left: 5px;
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 12px;
            padding: 0;
        }
        .remove-btn:hover {
            color: #333;
        }
        .no-results {
            padding: 12px;
            color: #666;
            font-size: 13px;
            text-align: center;
        }
        .hidden-input {
            display: none;
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
                        <form  id="blogForm" method="POST" action="{{ route('admin.blogs.update2', $blog->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="blogImage">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="blogImage" onchange="previewBolgImage(event)">
                                            <label class="custom-file-label" for="blogImage">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if ($blog->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $blog->images->first()->path) }}"
                                            alt="{{ $blog->title }}" id="currentImage" width="100" class="mt-2">
                                    @endif
                                    <img id="previewImage" src="#" alt="Image Preview" width="100"
                                        class="mt-2 d-none">
                                </div>
                                @if ($blog->images->isNotEmpty() && isset($blog->images->first()->alt) && !empty($blog->images->first()->alt))
                                    <div class="form-group">
                                        <label for="imagealt">Image Alt</label>
                                        <input type="text" name="alt"
                                            class="form-control @error('alt') is-invalid @enderror" id="imagealt"
                                            placeholder="Image Alt"
                                            value="{{ old('alt', $blog->images->first()->alt) }}">
                                        @error('alt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="Article Author">Article Author</label>
                                    <input type="text" name="article_author"
                                        class="form-control @error('article_author') is-invalid @enderror"
                                        id="blogarticle_author" placeholder="Enter Blog Article Author"
                                        value="{{ old('article_author', $blog->author) }}">
                                    @error('article_author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogTitle">Title</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" id="blogTitle"
                                        placeholder="Enter Blog Title" value="{{ old('title', $blog->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Tagename">Tagename</label>
                                    <input type="text" name="tagename"
                                        class="form-control @error('tagename') is-invalid @enderror" id="Tagename"
                                        placeholder="Enter Blog Tag" value="{{ old('tagename', $blog->tagname) }}">
                                    @error('tagename')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogDescription">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="blogDescription"
                                        placeholder="Enter Blog Description">{{ old('description', $blog->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogDescription">Meta Title</label>
                                    <textarea name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                                        placeholder="Enter Meta Title">{{ old('meta_title', $blog->seo_meta_tag_title) }}</textarea>
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogDescription">Meta Description</label>
                                    <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="blogDescription"
                                        placeholder="Enter Meta Description">{{ old('meta_description', $blog->seo_meta_tag) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                              <div class="dropdown-container">
        <div class="selected-items" id="selectedItems"></div>
        
        <div class="dropdown-wrapper">
            <input 
                type="text" 
                class="search-input" 
                id="searchInput" 
                placeholder="Search or select product"
                autocomplete="off"
            >
            <div class="dropdown-arrow" id="dropdownArrow">▼</div>
            <div class="dropdown-list" id="dropdownList"></div>
        </div>
        
        <input type="text" class="hidden-input" id="selectedIds" name="selectedIds">
        <input type="hidden"  id="selectedIds1" name="product_ids" value="{{old('product_ids', $blog->blog_product_ids)}}">
        <input type="hidden"  id="selectedIds2" name="" value="{{old('product_ids', $blog->blog_product_ids)}}">
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
                                         $yourString= old('content_html', $blog->content_html);
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
  const input = document.querySelector("#editormain");

  if (input) {
    input.addEventListener("paste", function (e) {
      e.preventDefault();

      const clipboard = e.clipboardData || window.clipboardData;
      const htmlData = clipboard.getData("text/html") || clipboard.getData("text/plain");

      const temp = document.createElement("div");
      temp.innerHTML = htmlData;

      // Remove only font-size from inline styles
      temp.querySelectorAll("[style]").forEach(el => {
        const style = el.getAttribute("style")
          .split(";")
          .filter(rule => !rule.trim().toLowerCase().startsWith("font-size"))
          .join(";");

        if (style.trim()) {
          el.setAttribute("style", style);
        } else {
          el.removeAttribute("style");
        }
      });

      // Insert cleaned HTML
      document.execCommand("insertHTML", false, temp.innerHTML);
    });
  }
});
</script>
<script>
    // Sample data that would come from Laravel
    // In real usage, you would use: 
    const laravelProducts = @json($products);
    
    // Conversion function - Laravel array to your required format
    function convertLaravelArray(laravelArray) {
            const converted = {};
            laravelArray.forEach(product => {
                converted[product.id] = {
                    id: product.id,
                    name: product.name,
                    category: product.category.name || 'Uncategorized' // Handle case where category might be null
                };
            });
            return converted;
        }

    class SearchableDropdown {
        constructor(initialSelectedIds = []) {
            // Convert the Laravel array to your required format
            this.products = convertLaravelArray(laravelProducts);
            
            // Initialize selected products
            this.selectedProducts = {};
            
            // Handle both string (from form) and array inputs
            if (typeof initialSelectedIds === 'string' && initialSelectedIds.length > 0) {
                initialSelectedIds = initialSelectedIds.split('|').map(id => parseInt(id.trim()));
            }
            
            if (Array.isArray(initialSelectedIds)) {
                initialSelectedIds.forEach(id => {
                    if (this.products[id]) {
                        this.selectedProducts[id] = this.products[id];
                    }
                });
            }
            
            this.filteredProducts = Object.values(this.products);
            this.isOpen = false;
            
            this.initElements();
            this.bindEvents();
            this.renderSelectedItems();
            this.renderDropdownItems();
            this.updateSelectedIds();
        }
        
        initElements() {
            this.searchInput = document.getElementById('searchInput');
            this.dropdownList = document.getElementById('dropdownList');
            this.dropdownArrow = document.getElementById('dropdownArrow');
            this.selectedItems = document.getElementById('selectedItems');
            this.selectedIdsInput = document.getElementById('selectedIds');
        }
        
        bindEvents() {
            this.searchInput.addEventListener('input', (e) => {
                this.handleSearch(e.target.value);
            });
            
            this.searchInput.addEventListener('focus', () => {
                this.openDropdown();
            });
            
            this.searchInput.addEventListener('click', () => {
                this.openDropdown();
            });
            
            this.dropdownArrow.addEventListener('click', () => {
                this.toggleDropdown();
            });
            
            document.addEventListener('click', (e) => {
                if (!this.dropdownList.contains(e.target) && 
                    !this.searchInput.contains(e.target) && 
                    !this.dropdownArrow.contains(e.target)) {
                    this.closeDropdown();
                }
            });
        }
        
        handleSearch(query) {
            this.filteredProducts = Object.values(this.products).filter(product => 
                product.name.toLowerCase().includes(query.toLowerCase()) &&
                !this.selectedProducts[product.id]
            );
            this.renderDropdownItems();
            this.openDropdown();
        }
        
        toggleDropdown() {
            this.isOpen ? this.closeDropdown() : this.openDropdown();
        }
        
        openDropdown() {
            this.dropdownList.style.display = 'block';
            this.isOpen = true;
            this.dropdownArrow.textContent = '▲';
        }
        
        closeDropdown() {
            this.dropdownList.style.display = 'none';
            this.isOpen = false;
            this.dropdownArrow.textContent = '▼';
        }
        
        renderDropdownItems() {
            if (this.filteredProducts.length === 0) {
                this.dropdownList.innerHTML = '<div class="no-results">No matching products found</div>';
                return;
            }
            
            this.dropdownList.innerHTML = this.filteredProducts
                .map(product => `
                    <div class="dropdown-item" data-id="${product.id}">
                        <div class="product-name">${product.name}</div>
                        <div class="category">${product.category}</div>
                    </div>
                `).join('');
            
            this.dropdownList.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', () => {
                    const id = parseInt(item.dataset.id);
                    this.selectProduct(id);
                });
            });
        }
        
        selectProduct(id) {
            if (!this.selectedProducts[id]) {
                this.selectedProducts[id] = this.products[id];
                this.renderSelectedItems();
                this.updateSelectedIds();
                this.closeDropdown();
                this.searchInput.value = '';
                this.handleSearch('');
                this.searchInput.focus();
            }
        }
        
        removeProduct(id) {
            delete this.selectedProducts[id];
            this.renderSelectedItems();
            this.updateSelectedIds();
            this.filteredProducts = Object.values(this.products).filter(p => 
                !this.selectedProducts[p.id]
            );
            this.renderDropdownItems();
        }
        
        renderSelectedItems() {
            const selectedProducts = Object.values(this.selectedProducts);
            
            if (selectedProducts.length === 0) {
                this.selectedItems.innerHTML = '';
                return;
            }
            
            this.selectedItems.innerHTML = selectedProducts
                .map(product => `
                    <div class="selected-tag">
                        ${product.name}
                        <button class="remove-btn" data-id="${product.id}">✕</button>
                    </div>
                `).join('');
            
            this.selectedItems.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const productId = parseInt(btn.dataset.id);
                    this.removeProduct(productId);
                });
            });
        }
        
        updateSelectedIds() {
            const idsString = Object.keys(this.selectedProducts).join('|');
            this.selectedIdsInput.value = idsString;
            document.getElementById('selectedIds1').value=idsString;
        }
    }

    // Initialize when page loads - handles both create and update scenarios
    document.addEventListener('DOMContentLoaded', () => {
        // Get pre-selected IDs from hidden input (format: "1|3|5")
        const selectedIdsInput = document.getElementById('selectedIds2');
        const initialValue = selectedIdsInput ? selectedIdsInput.value : '';
        
        new SearchableDropdown(initialValue);
    });
</script>

@endsection
