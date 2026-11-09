===source===
<?php
trait T { #[\NoDiscard] public function __clone() {} }
===errors <=7.4===
missing closing '}'
===errors >=8.5===
Method T::__clone cannot be #[\NoDiscard]
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Method T::__clone cannot be #[\NoDiscard] in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 46,
                      "end": 53
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 18,
                          "end": 28
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 18,
                        "end": 28
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
