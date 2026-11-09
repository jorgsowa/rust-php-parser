===source===
<?php
new enum instanceof X;
===errors >=8.1===
expected class name, found 'enum'
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "enum" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "enum", expecting "class" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "enum"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 10,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 10,
                        "end": 14
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "X"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
