===source===
<?php

class a {
    static protected function __callstatic($a, $b) {
    }
}

?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "a",
            "span": {
              "start": 13,
              "end": 14
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
                    "name": "__callstatic",
                    "span": {
                      "start": 47,
                      "end": 59
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 60,
                          "end": 62
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 60,
                        "end": 62
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 64,
                          "end": 66
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 64,
                        "end": 66
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 75
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 77
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 79,
        "end": 81
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81
  }
}
