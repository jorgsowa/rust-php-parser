===config===
php_rejects=deprecated
===source===
<?php
$a =& new B;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "B"
                      },
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 17
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 2
