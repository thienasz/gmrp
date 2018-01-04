import { Component, OnInit } from '@angular/core';
import { DialogAccountForm } from './account-form/account-form.component';
import { MatDialog } from '@angular/material';
import { AccountService } from './account.service';

@Component({
  selector: 'app-account',
  templateUrl: './account.component.html',
  styleUrls: ['./account.component.scss']
})
export class AccountComponent implements OnInit {
  account: any;
  accounts: any;

  currentPage: Number = 1;
  totalItems: Number = 0;
  itemsPerPage: Number = 15;
  constructor (
    public dialog: MatDialog,
    private accountService: AccountService
  ) {}

  openDialog(): void {
    const dialogRef = this.dialog.open(DialogAccountForm, {
      width: '350px',
      data: { account: this.account }
    });

    dialogRef.afterClosed().subscribe(result => {
      this.getAccountList();
    });
  }

  ngOnInit() {
    this.getAccountList();
  }

  pageChanged($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.pageIndex + 1;
    this.getAccountList();
  }

  getAccountList() {
    this.accountService.getAccount(this.currentPage).subscribe(
      (req) => {
        console.log(req);
        this.accounts = req.data;
        this.itemsPerPage = req.per_page;
        this.totalItems = req.total;
      });
  }
}
