===source===
<?php
outer:
class C {
    public function m() {
        goto outer;
    }
}
===errors===
'goto' to undefined label 'outer'
===php_error===
PHP Fatal error:  'goto' to undefined label 'outer' in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "outer",
          "span": {
            "start": 6,
            "end": 11
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
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 19,
              "end": 20
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
                    "name": "m",
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Goto": {
                          "name": "outer",
                          "span": {
                            "start": 62,
                            "end": 67
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 68
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 74
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 13,
        "end": 76
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}
