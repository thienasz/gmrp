import { Component, OnInit } from '@angular/core';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.scss']
})
export class UserComponent implements OnInit {
  currentPage:number = 1;
  totalItems:number = 0;
  itemsPerPage: number = 15; 
  currentPageFb:number = 1;
  totalItemsFb:number = 0;
  itemsPerPageFb: number = 15; 
  
  fbUsers: any;
  nmUsers:any;

  constructor(
    private userService: UserService,
  ) { }

  ngOnInit() {

    this.getUsers();
    this.getUsersFb();
  }

  getUsers() {
    this.userService.getUsers(this.currentPage, 0).subscribe(
      (req) => {
        console.log(req);
        this.nmUsers = req.data;
        this.itemsPerPage = req.per_page;
        this.totalItems = req.total;
      }
    )
  }

  getUsersFb() {
    this.userService.getUsers(this.currentPageFb, 2).subscribe(
      (req) => {
        console.log(req);
        this.fbUsers = req.data;
        this.itemsPerPageFb = req.per_page;
        this.totalItemsFb = req.total;
      }
    )
  }

  pageChanged($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.page;
    this.getUsers();
  }

  pageChangedFb($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.page;
    this.getUsersFb();
  }
}
