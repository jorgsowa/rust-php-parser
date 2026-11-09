===source===
<?php
class D {
    static function __callStatic($a, $b) {}
    static function __set_state($a) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
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
                    "name": "__callStatic",
                    "span": {
                      "start": 36,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 49,
                          "end": 51
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 49,
                        "end": 51
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 53,
                          "end": 55
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 53,
                        "end": 55
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 59
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 80,
                      "end": 91
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 92,
                          "end": 94
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 92,
                        "end": 94
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 64,
                "end": 98
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 100
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 100
  }
}
