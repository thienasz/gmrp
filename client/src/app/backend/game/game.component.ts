import { Component, TemplateRef, OnInit, ViewChild } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { GameService } from '../services/game.service';
import { ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.scss']
})
export class GameComponent implements OnInit {
  @ViewChild('smallModal') smallModal: BsModalRef;

  createGameForm: FormGroup;
  currentPage:number = 1;
  totalItems:number = 0;
  itemsPerPage: number = 15; 

  constructor(
    private gameService: GameService,
    private activeRoute: ActivatedRoute,
    private fb: FormBuilder,
  ) {}
 
  // openModal(template: TemplateRef<any>) {
  //   this.modalRef = this.modalService.show(template, {
  //     class: "show"
  //   });
  // }

  games: Array<any> = [];

  ngOnInit() {
    this.createGameForm = this.fb.group({
      name: ['', Validators.required],
      description: ['', Validators.required]
    })
    this.getGames();
  }

  onSubmit() {
    if(this.createGameForm.valid) {
      this.gameService.create(this.createGameForm.value).subscribe(
        (req) => {
          console.log(req);
          this.smallModal.hide();
          this.getGames();
        }
      )
    }
  }

  pageChanged($event) {
    console.log(this.currentPage);
    console.log($event);
    this.currentPage = $event.page;
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
