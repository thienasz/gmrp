import { Component, OnInit, Input, EventEmitter, Output } from '@angular/core';
import { FormControl } from '@angular/forms';
import { FormGroup } from '@angular/forms/src/model';
import { RoleService } from '../../../backend/role/role.service';

@Component({
  selector: 'app-select-role',
  templateUrl: './select-role.component.html',
  styleUrls: ['./select-role.component.scss']
})
export class SelectRoleComponent implements OnInit {
  @Input() role: FormControl = new FormControl();
  @Output() change: EventEmitter<any> = new EventEmitter<any>();
  roleTem: FormControl;

  roles: any;

  constructor(
    private roleService: RoleService,
  ) { }

  ngOnInit() {
    console.log("init gm s");
    this.roleTem = new FormControl('', this.role.validator);
    this.roleService.getRoles().subscribe(
      (req) => {
        console.log(req);
        this.roles = req.data;
      }
    )
  }

  onChange($event, selected) {
    if($event.isUserInput) {
      console.log(selected);
      this.role.setValue(selected.id);
      this.change.emit(selected);
    }
  }
}
