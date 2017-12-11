import { Component, OnInit } from '@angular/core';
import { ProductService } from 'app/shared/services/product/product.service';

@Component({
  selector: 'ntd-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.scss']
})
export class ProductComponent implements OnInit {
  productList: any = [];
  constructor(
    private product: ProductService
  ) { }

  ngOnInit() {
    this.product.getHotProduct().subscribe(res => {
      this.productList = res.data;
    }, err => {

    });
  }

}
