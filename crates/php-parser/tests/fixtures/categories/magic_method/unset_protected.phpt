===source===
<?php

class foo {
    protected function __unset($a) {
        print "unset\n";
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
                      "start": 42,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 50,
                          "end": 52
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 52
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
                                "start": 70,
                                "end": 79
                              }
                            }
                          },
                          "span": {
                            "start": 64,
                            "end": 79
                          }
                        }
                      },
                      "span": {
                        "start": 64,
                        "end": 80
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 86
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 88
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 90,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
