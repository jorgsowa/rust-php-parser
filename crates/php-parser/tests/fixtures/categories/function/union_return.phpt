===source===
<?php function foo(): int|string { return 1; }
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 42,
                    "end": 43
                  }
                }
              },
              "span": {
                "start": 35,
                "end": 44
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 22,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 25
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "string"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 32
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 32
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 32
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
