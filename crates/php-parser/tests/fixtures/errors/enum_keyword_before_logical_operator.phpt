===source===
<?php
$x = enum and 1;
===errors >=8.1===
expected expression, found 'enum'
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "enum" in Standard input code on line 2
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
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "enum"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 11,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "LogicalAnd",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
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
