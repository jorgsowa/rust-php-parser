===source===
<?php foo(1, 2
===errors===
expected ')', found end of file
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting ')' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '(' in Standard input code on line 1
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
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 11
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 14
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
