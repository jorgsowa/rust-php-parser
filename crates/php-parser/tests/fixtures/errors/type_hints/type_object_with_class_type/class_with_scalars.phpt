===source===
<?php
function b(): int|A|object|null {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
Type A|object|int|null contains both object and a class type, which is redundant
===errors >=8.0===
Type A|object|int|null contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Type A|object|int|null contains both object and a class type, which is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
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
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
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
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 33,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 37
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 37
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
