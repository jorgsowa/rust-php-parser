===source===
<?php
new Foo(?);
===errors >=8.6===
Cannot use partial function application in new expression
===php_error===
PHP Fatal error:  Cannot create Closure for new expression in Standard input code on line 2
===ast >=8.6===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": "Placeholder",
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
