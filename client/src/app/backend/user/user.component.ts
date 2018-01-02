import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { UserService } from './user.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.scss']
})
export class UserComponent implements OnInit {
  multiMonthUser: Array<any> = [];
  monthUser: Array<any> = [];
  mauArray: Array<any> = [];
  truArray: Array<any> = [];
  mlauArray: Array<any> = [];

  now = new Date();
  dateControl = new FormControl(this.now);
  optionControl = new FormControl("1");

  games: any = ["Game a", "Game b", "Game c"];
  constructor(
    private userService: UserService,
  ) {
    for (let i = 1; i < 13; i++) {
      let tru = Math.floor((Math.random() * 500000) + 1);
      let mau = Math.floor(Math.random() * (tru - 1 + 1)) + 1;


      this.mauArray.push({
        "name": "Thang " + i,
        "value": mau
      });
      this.truArray.push({
        "name": "Thang " + i,
        "value": tru
      });
      this.mlauArray.push({
        "name": "Thang " + i,
        "value": mau/tru
      });

      this.multiMonthUser.push({
        "name": "Thang " + i,
        "series": [
          {
            "name": "TRU",
            "value": tru
          },
          {
            "name": "MAU",
            "value": mau
          }
        ]
      });
    }

  }

  
  ngOnInit() {
    this.monthUser = this.truArray;
    this.optionControl.valueChanges.subscribe(
      (req) => {
        if(req == "1") {
          this.monthUser = this.truArray;
        } else if(req == "2") {
          this.monthUser = this.mauArray;
        } else {
          this.monthUser = this.mlauArray;
        }
      }
    )


    this.getUsers();
    this.getUsersFb();
  }


  dayUser = [
    {
      name: "New Register User",
      value: 32
    },
    {
      name: "Daily Active User",
      value: 14
    },
    {
      name: "Current Active User",
      value: 10
    },
  ];


  currentPage:number = 1;
  totalItems:number = 0;
  itemsPerPage: number = 15; 
  currentPageFb:number = 1;
  totalItemsFb:number = 0;
  itemsPerPageFb: number = 15; 
   
  fbUsers: any;
  nmUsers:any;

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
    this.currentPage = $event.page + 1;
    this.getUsers();
  }

  pageChangedFb($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.page + 1;
    this.getUsersFb();
  }
}
