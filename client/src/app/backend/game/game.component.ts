import { Component, OnInit } from '@angular/core';
import { DialogGameForm } from './game-form/game-form.component';
import { MatDialog } from '@angular/material';
import { GameService } from './game.service';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.scss']
})
export class GameComponent implements OnInit {
  game: any;
  games: any;

  currentPage:number = 1;
  totalItems:number = 0;
  itemsPerPage: number = 15; 

  constructor(
    public dialog: MatDialog,
    private gameService: GameService
  ) {}

  openDialog(): void {
    let dialogRef = this.dialog.open(DialogGameForm, {
      width: '350px',
      data: { game: this.game }
    });

    dialogRef.afterClosed().subscribe(result => {
      this.getGames();
    });
  }

  ngOnInit() {
    this.getGames();
  }

  pageChanged($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.pageIndex + 1;
    this.getGames();
  }

  getGames() {
    this.gameService.getGames(this.currentPage).subscribe(
      (req) => {
        console.log(req);
        this.games = req.data;
        this.itemsPerPage = req.per_page;
        this.totalItems = req.total;
      }
    )
  }
}
