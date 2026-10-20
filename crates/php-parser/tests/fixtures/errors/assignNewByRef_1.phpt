===source===
<?php
$a =& new B;
===errors >=7.4===
Cannot use by-reference assignment with 'new' expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'new' (T_NEW) in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "new" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 2
===ast >=7.4===
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
                            "start": 16,
                            "end": 17
                          }
                        }
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
