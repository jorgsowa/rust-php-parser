===source===
<?php
list($a) = &f();
===errors===
Cannot assign by reference to a destructuring pattern
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "&" in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 11,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 18,
                  "end": 21
                }
              },
              "by_ref": true
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
