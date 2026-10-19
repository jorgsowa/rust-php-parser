===source===
<?php

class foo {
    private function __unset($a) {
        print "unset\n";
    }
}

?>
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "foo",
            "span": {
              "start": 13,
              "end": 16
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
                    "name": "__unset",
                    "span": {
                      "start": 40,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 48,
                          "end": 50
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 50
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Print": {
                              "kind": {
                                "String": "unset\n"
                              },
                              "span": {
                                "start": 68,
                                "end": 77
                              }
                            }
                          },
                          "span": {
                            "start": 62,
                            "end": 77
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 78
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 86
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86
  }
}
