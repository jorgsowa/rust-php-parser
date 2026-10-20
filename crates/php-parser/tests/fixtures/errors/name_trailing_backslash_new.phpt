===source===
<?php
$a = new Bar\;
===errors >=8.5===
expected identifier, found ';'
===php_error===
PHP Parse error:  syntax error, unexpected token "\" in Standard input code on line 2
===ast >=8.5===
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
                        "Name": {
                          "parts": [
                            "Bar"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 15,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 18
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
