import { Component, TemplateRef, OnInit, ViewChild } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { AgencyService } from '../services/agency.service';
import { ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
@Component({
  selector: 'app-agency',
  templateUrl: './agency.component.html',
  styleUrls: ['./agency.component.scss']
})
export class AgencyComponent implements OnInit {
  @ViewChild('smallModal') smallModal: BsModalRef;

  createAgencyForm: FormGroup;
  currentPage:number = 1;
  totalItems:number = 0;
  itemsPerPage: number = 15; 

  constructor(
    private agencyService: AgencyService,
    private activeRoute: ActivatedRoute,
    private fb: FormBuilder,
  ) {}
 
  // openModal(template: TemplateRef<any>) {
  //   this.modalRef = this.modalService.show(template, {
  //     class: "show"
  //   });
  // }

  agencies: Array<any> = [];

  ngOnInit() {
    this.createAgencyForm = this.fb.group({
      name: ['', Validators.required],
      description: ['', Validators.required],
      percent_share: ['', Validators.required]
    })
    this.getAgencies();
  }

  onSubmit() {
    if(this.createAgencyForm.valid) {
      this.agencyService.create(this.createAgencyForm.value).subscribe(
        (req) => {
          console.log(req);
          this.smallModal.hide();
          this.getAgencies();
        }
      )
    }
  }

  pageChanged($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.page;
    this.getAgencies();
  }

  getAgencies() {
    this.agencyService.getAgencies(this.currentPage).subscribe(
      (req) => {
        console.log(req);
        this.agencies = req.data;
        this.itemsPerPage = req.per_page;
        this.totalItems = req.total;
      }
    )
  }
}
