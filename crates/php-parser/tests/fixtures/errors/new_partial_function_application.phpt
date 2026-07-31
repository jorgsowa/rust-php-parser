===config===
min_php=8.6
===source===
<?php
new Foo(?);
===errors===
Cannot use partial function application in new expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "value": null,
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 15
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
