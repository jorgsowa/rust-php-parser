===source===
<?php $fn = clone(...);
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'clone(...) first-class callable' requires PHP 8.5 or higher
===errors 8.1-8.4===
'clone(...) first-class callable' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '...' (T_ELLIPSIS) in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "..." in Standard input code on line 1
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "clone"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 12,
                              "end": 17
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 17
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
