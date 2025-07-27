<div class="row">
  <div class="column">
    <img src="https://i.imgur.com/LBFnJzd.gif" style="width:100%" class="image">
    <div class="middle">
    <div class="text">John Doe</div>
  </div>
  </div>

  <div class="column">
    <img src="https://i.imgur.com/eOrPIjL.png" style="width:100%" class="image">
    <div class="middle">
      <div class="text">John Doe</div>
    </div>
  </div>

  <div class="column">
    <img src="https://i.imgur.com/HWi1rPW.png" class="image" style="width:100%">
    <div class="middle">
      <div class="text">John Doe</div>
    </div>
  </div>
</div>
Extra CSS

.column {
    position: relative;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.column:hover .image {
  opacity: 0.3;
}

.column:hover .middle {
  opacity: 1;
}

.text {
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}


<video width="600" height="409" id="videoPlayer" controls="controls">
  <!-- MP4 Video -->
  <source src="img/small.mp4" type="video/mp4">
</video>