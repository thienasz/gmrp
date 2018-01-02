import { Component, OnInit, Input } from '@angular/core';
import { FormControl } from '@angular/forms';
import { AgencyService } from '../../../backend/agency/agency.service';

@Component({
  selector: 'app-select-agency',
  templateUrl: './select-agency.component.html',
  styleUrls: ['./select-agency.component.scss']
})
export class SelectAgencyComponent implements OnInit {
  @Input() agency: FormControl = new FormControl();
  
  agencies: any;

  constructor(
    private agencyService: AgencyService,
  ) { }

  ngOnInit() {
    this.agencyService.getAgencies().subscribe(
      (req) => {
        console.log(req);
        this.agencies = req.data;
      }
    )
  }

  onChange($event, selected) {
    if($event.isUserInput) {
      this.agency.setValue(selected.id);
    }
  }
}
