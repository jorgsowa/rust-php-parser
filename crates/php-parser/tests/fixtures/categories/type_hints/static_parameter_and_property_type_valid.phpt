===source===
<?php
class C {
    public function f(): ?static {}
}
===errors <=7.4===
'static type' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 42,
                              "end": 48
                            }
                          }
                        },
                        "span": {
                          "start": 42,
                          "end": 48
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 48
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
