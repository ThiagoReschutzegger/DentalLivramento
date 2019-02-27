<div class="container-fluid" style="margin-top: 50px">
<div class="col-lg-12">
  <div class="card">
    <div class="card-close">
      <div class="dropdown">
        <button type="button" id="closeCard5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
        <div aria-labelledby="closeCard5" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
      </div>
    </div>
    <div class="card-header d-flex align-items-center">
      <h3 class="h4">All form elements</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal">
        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Normal</label>
          <div class="col-sm-9">
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Help text</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"><small class="help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</small>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Password</label>
          <div class="col-sm-9">
            <input type="password" name="password" class="form-control">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Placeholder</label>
          <div class="col-sm-9">
            <input type="text" placeholder="placeholder" class="form-control">
          </div>
        </div>
        <div class="line"></div>








        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Select</label>
          <div class="col-sm-9">
            <select name="account" class="form-control mb-3">
              <option>option 1</option>
              <option>option 2</option>
              <option>option 3</option>
              <option>option 4</option>
            </select>
          </div>
          <div class="col-sm-9 offset-sm-3">
            <select multiple="" class="form-control">
              <option>option 1</option>
              <option>option 2</option>
              <option>option 3</option>
              <option>option 4</option>
            </select>
          </div>
        </div>
        <div class="line"></div>


        <div class="form-group row has-success">
          <label class="col-sm-3 form-control-label">Input with success</label>
          <div class="col-sm-9">
            <input type="text" class="form-control is-valid">
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row has-danger">
          <label class="col-sm-3 form-control-label">Input with error</label>
          <div class="col-sm-9">
            <input type="text" class="form-control is-invalid">
            <div class="invalid-feedback">Please provide your name.</div>
          </div>
        </div>
        <div class="line"></div>




        <div class="row">
          <label class="col-sm-3 form-control-label">Material Inputs</label>
          <div class="col-sm-9">
            <div class="form-group-material">
              <input id="register-username" type="text" name="registerUsername" required="" class="input-material">
              <label for="register-username" class="label-material">Username</label>
            </div>
            <div class="form-group-material">
              <input id="register-email" type="email" name="registerEmail" required="" class="input-material">
              <label for="register-email" class="label-material">Email Address      </label>
            </div>
            <div class="form-group-material">
              <input id="register-password" type="password" name="registerPassword" required="" class="input-material">
              <label for="register-password" class="label-material">Password     </label>
            </div>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Input groups</label>
          <div class="col-sm-9">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                <input type="text" placeholder="Username" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control">
                <div class="input-group-append"><span class="input-group-text">.00</span></div>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                <input type="text" class="form-control">
                <div class="input-group-append"><span class="input-group-text">.00</span></div>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox">
                  </div>
                </div>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="checkbox" class="checkbox-template">
                  </div>
                </div>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="radio">
                  </div>
                </div>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <input type="radio" class="radio-template">
                  </div>
                </div>
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="line"></div>


        <div class="form-group row">
          <label class="col-sm-3 form-control-label">With dropdowns</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-prepend">
                <button data-toggle="dropdown" type="button" class="btn btn-outline-secondary dropdown-toggle">Action <span class="caret"></span></button>
                <div class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
                  <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <input type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="line"></div>
        <div class="form-group row">
          <div class="col-sm-4 offset-sm-3">
            <button type="submit" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
