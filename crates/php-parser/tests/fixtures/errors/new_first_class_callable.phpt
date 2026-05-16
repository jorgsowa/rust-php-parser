===source===
<?php
new Foo(...);
===errors===
Cannot create Closure for new expression
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
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
===php_error===
PHP Fatal error:  Cannot create Closure for new expression in Standard input code on line 2
