===source===
<?php clone(...$args);
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
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "clone"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "args"
                      },
                      "span": {
                        "start": 15,
                        "end": 20
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 20
                  }
                }
              ]
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
