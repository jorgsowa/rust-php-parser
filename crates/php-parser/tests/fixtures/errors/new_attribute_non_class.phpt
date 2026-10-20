===source===
<?php
$a = new #[A] B;
===errors >=8.5===
expected 'class', found identifier
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected identifier "B", expecting "class" or "#[" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected identifier "B", expecting "class" in Standard input code on line 2
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
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 20,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
