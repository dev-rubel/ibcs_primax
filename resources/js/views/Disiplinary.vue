<template>
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
      <h1 class="h3 mb-0 text-gray-800">Disiplinary List</h1>
      <button
        type="button"
        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
        v-on:click="showDisipModel"
      >
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Disiplinary
      </button>
    </div>

    <!-- Content Row -->
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered" ref="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Go Date</th>
              <th>Offence</th>
              <th>Name of Punishment</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(disip, index) in disipList" :key="index">
              <td>{{index+1}}</td>
              <td>{{disip.go_date}}</td>
              <td>{{disip.offence}}</td>
              <td>{{disip.nature_of_punishment}}</td>
              <th>
                <button type="button" class="btn btn-sm btn-warning" v-on:click="disipEdit(disip)">
                  <i class="fa fa-pencil-alt"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger" v-on:click="disipDelete(disip)">
                  <i class="fa fa-trash-alt"></i>
                </button>
              </th>
            </tr>
            <tr v-if="disipList == ''">
              <td class="text-center" colspan="5">No data found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <b-modal ref="disipModel" hide-footer title="Add New Disiplinary">
      <div class="d-block">
        <div id="globalErrors" v-if="globalErrors">
          <div
            class="invalid-feedback"
            v-for="(error, index) in globalErrors"
            :key="index"
          >{{error}}</div>
        </div>
        <form v-on:submit.prevent="createDisip">
          <div class="form-group">
            <label for="date">Go Date</label>
            <input
              type="date"
              v-model="disipData.date"
              class="form-control"
              id="date"
              placeholder="Please Enter Date"
            />
            <div class="invalid-feedback" v-if="errors.date">{{errors.date[0]}}</div>
          </div>
          <div class="form-group">
            <label for="offence">Offence</label>
            <select class="form-control" id="offence" v-model="disipData.offence">
              <option value>Please Select Offence</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
            <div class="invalid-feedback" v-if="errors.offence">{{errors.offence[0]}}</div>
          </div>
          <div class="form-group">
            <label for="natureOfPunishment">Nature of Punishment</label>
            <select
              class="form-control"
              id="natureOfPunishment"
              v-model="disipData.natureOfPunishment"
            >
              <option value>Please Nature of Punishment</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
            <div
              class="invalid-feedback"
              v-if="errors.natureOfPunishment"
            >{{errors.natureOfPunishment[0]}}</div>
          </div>
          <div class="form-group">
            <label for="punishmentLine_1">Punishment Line 1</label>
            <input
              type="text"
              v-model="disipData.punishmentLine_1"
              class="form-control"
              id="punishmentLine_1"
              placeholder="Please Enter Punishment Line 1"
            />
          </div>
          <div class="form-group">
            <label for="punishmentLine_2">Punishment Line 2</label>
            <input
              type="text"
              v-model="disipData.punishmentLine_2"
              class="form-control"
              id="punishmentLine_2"
              placeholder="Please Enter Punishment Line 2"
            />
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <input
              type="text"
              v-model="disipData.remarks"
              class="form-control"
              id="remarks"
              placeholder="Please Enter Remarks"
            />
          </div>
          <div class="text-right">
            <button type="button" class="btn btn-default" v-on:click="hideDisipModel">Cancel</button>
            <button type="submit" class="btn btn-primary">
              <span class="fa fa-check"></span> Save
            </button>
          </div>
        </form>
      </div>
    </b-modal>

    <b-modal ref="disipEditModel" hide-footer title="Edit Disiplinary">
      <div class="d-block">
        <div id="globalErrors" v-if="globalErrorsEdit">
          <div
            class="invalid-feedback"
            v-for="(error, index) in globalErrorsEdit"
            :key="index"
          >{{error}}</div>
        </div>
        <form v-on:submit.prevent="disipUpdate">
          <div class="form-group">
            <label for="date">Go Date</label>
            <input
              type="date"
              v-model="disipEditData.go_date"
              class="form-control"
              id="date"
              placeholder="Please Enter Date"
            />
            <div class="invalid-feedback" v-if="errorsEdit.date">{{errorsEdit.date[0]}}</div>
          </div>
          <div class="form-group">
            <label for="offence">Offence</label>
            <select class="form-control" id="offence" v-model="disipEditData.offence">
              <option value>Please Select Offence</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
            <div class="invalid-feedback" v-if="errorsEdit.offence">{{errorsEdit.offence[0]}}</div>
          </div>
          <div class="form-group">
            <label for="natureOfPunishment">Nature of Punishment</label>
            <select
              class="form-control"
              id="natureOfPunishment"
              v-model="disipEditData.nature_of_punishment"
            >
              <option value>Please Nature of Punishment</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
            <div
              class="invalid-feedback"
              v-if="errorsEdit.natureOfPunishment"
            >{{errorsEdit.natureOfPunishment[0]}}</div>
          </div>
          <div class="form-group">
            <label for="punishmentLine_1">Punishment Line 1</label>
            <input
              type="text"
              v-model="disipEditData.punishment_line_1"
              class="form-control"
              id="punishmentLine_1"
              placeholder="Please Enter Punishment Line 1"
            />
          </div>
          <div class="form-group">
            <label for="punishmentLine_2">Punishment Line 2</label>
            <input
              type="text"
              v-model="disipEditData.punishment_line_2"
              class="form-control"
              id="punishmentLine_2"
              placeholder="Please Enter Punishment Line 2"
            />
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <input
              type="text"
              v-model="disipEditData.remarks"
              class="form-control"
              id="remarks"
              placeholder="Please Enter Remarks"
            />
          </div>
          <div class="text-right">
            <button type="button" class="btn btn-default" v-on:click="hideDisipEditModel">Cancel</button>
            <button type="submit" class="btn btn-success">
              <span class="fa fa-check"></span> Update
            </button>
          </div>
        </form>
      </div>
    </b-modal>
  </div>
</template>

<script>
import * as disipService from "../services/disip_service";
export default {
  name: "disip",
  data() {
    return {
      disipList: [],
      disipEditData: {},
      disipData: {
        date: "",
        offence: "",
        natureOfPunishment: "",
        punishmentLine_1: "",
        punishmentLine_2: "",
        remarks: ""
      },
      errors: {},
      globalErrors: {},
      errorsEdit: {},
      globalErrorsEdit: {}
    };
  },
  mounted() {
    this.loadDisip();
  },
  methods: {
    showDisipModel() {
      this.$refs.disipModel.show();
    },
    hideDisipModel() {
      this.$refs.disipModel.hide();
    },
    // get disip
    loadDisip: async function() {
      try {
        const response = await disipService.loadDisip();
        this.disipList = response.data.data;
      } catch (error) {
        this.flashMessage.error({
          title: "Disiplinary List Load !!"
        });
      }
    },
    // create disip
    createDisip: async function(disip) {
      let formData = new FormData();
      formData.append("date", this.disipData.date);
      formData.append("offence", this.disipData.offence);
      formData.append("natureOfPunishment", this.disipData.natureOfPunishment);
      formData.append("punishmentLine_1", this.disipData.punishmentLine_1);
      formData.append("punishmentLine_2", this.disipData.punishmentLine_2);
      formData.append("remarks", this.disipData.remarks);

      try {
        const response = await disipService.createDisip(formData);
        this.disipList.unshift(response.data);
        disip.target.reset();
        this.hideDisipModel();
        this.flashMessage.success({
          title: "Disiplinary Insert Success :)"
        });
      } catch (error) {
        if (error.response.status == 422) {
          this.errors = error.response.data.errors;
        } else {
          this.globalErrors = error.response.data.errors;
        }
      }
    },
    // delete disip
    disipDelete: async function(disip) {
      if (!window.confirm("Are you sure you want to delete?")) {
        return;
      }
      console.log(disip.id);
      try {
        const response = await disipService.deleteDisip(disip.id);
        if (response.status !== 200) {
          this.flashMessage.error({
            title: "Error Occured!!"
          });
        } else {
          this.disipList = this.disipList.filter(obj => {
            return obj.id != disip.id;
          });
          this.flashMessage.success({
            title: "Data Delete Success"
          });
        }
        console.log(response);
      } catch (error) {
        this.flashMessage.error({
          title: "Error Occured!!"
        });
      }
    },
    showDisipEditModel() {
      this.$refs.disipEditModel.show();
    },
    hideDisipEditModel() {
      this.$refs.disipEditModel.hide();
    },
    // edit disip
    disipEdit(disip) {
      this.disipEditData = disip;
      this.disipEditData.punishment_line_1 =
        this.disipEditData.punishment_line_1 == "null"
          ? ""
          : this.disipEditData.punishment_line_1;
      this.disipEditData.punishment_line_2 =
        this.disipEditData.punishment_line_2 == "null"
          ? ""
          : this.disipEditData.punishment_line_2;
      this.disipEditData.remarks =
        this.disipEditData.remarks == "null" ? "" : this.disipEditData.remarks;
      this.showDisipEditModel();
    },
    // update disip
    disipUpdate: async function() {
      let formData = new FormData();
      formData.append("date", this.disipEditData.go_date);
      formData.append("offence", this.disipEditData.offence);
      formData.append(
        "natureOfPunishment",
        this.disipEditData.nature_of_punishment
      );
      formData.append("punishmentLine_1", this.disipEditData.punishment_line_1);
      formData.append("punishmentLine_2", this.disipEditData.punishment_line_2);
      formData.append("remarks", this.disipEditData.remarks);
      formData.append("id", this.disipEditData.id);
      formData.append("_method", "put");

      try {
        const response = await disipService.upateDisip(
          this.disipEditData.id,
          formData
        );
        if (response.status !== 200) {
          this.flashMessage.success({
            title: "Disiplinary Update Success :)"
          });
        } else {
          this.flashMessage.error({
            title: "Disiplinary Update error!!"
          });
        }
        this.hideDisipEditModel();
        this.flashMessage.success({
          title: "Disiplinary Update Success :)"
        });
      } catch (error) {
        if (error.response.status == 422) {
          this.errorsEdit = error.response.data.errors;
        } else {
          this.globalErrorsEdit = error.response.data.errors;
        }
      }
    }
  }
};
</script>