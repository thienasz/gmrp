import { Component, OnInit } from '@angular/core';
import { UserService } from '../user/user.service';
import { MatDialog } from '@angular/material';
import { DialogAdminUserForm } from './admin-user-form/admin-user-form.component';

@Component({
  selector: 'app-admin-user',
  templateUrl: './admin-user.component.html',
  styleUrls: ['./admin-user.component.scss']
})
export class AdminUserComponent implements OnInit {

  constructor(
    private userService: UserService,
    public dialog: MatDialog,
  ) { }

  ngOnInit() {
  }

  currentPage:number = 1;
  totalItems:number = 0;
  itemsPerPage: number = 15; 
  
  user: any;
  adUsers:any;

  getUsers() {
    this.userService.getUsers(this.currentPage, 1).subscribe(
      (req) => {
        this.adUsers = req.data;
        this.itemsPerPage = req.per_page;
        this.totalItems = req.total;
      }
    )
  }

  pageChanged($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.page + 1;
    this.getUsers();
  }

  openDialog(): void {
    let dialogRef = this.dialog.open(DialogAdminUserForm, {
      width: '500px',
      data: this.user
    });

    dialogRef.afterClosed().subscribe(result => {
      this.getUsers();
    });
  }

}
