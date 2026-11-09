===source===
<?php
$a = ;
$b = ;
function healthy(): string { return 'ok'; }
===errors===
expected expression, found ';'
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 2
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
                "kind": "Error",
                "span": {
                  "start": 10,
                  "end": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 17,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 13,
            "end": 17
          }
        }
      },
      "span": {
        "start": 13,
        "end": 19
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "healthy",
            "span": {
              "start": 29,
              "end": 36
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "String": "ok"
                  },
                  "span": {
                    "start": 56,
                    "end": 60
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 61
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "string"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 40,
                  "end": 46
                }
              }
            },
            "span": {
              "start": 40,
              "end": 46
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 20,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
