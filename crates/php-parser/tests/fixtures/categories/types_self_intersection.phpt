===source===
<?php
// Self in intersection type — valid only from PHP 8.5+
class TestSelfIntersection {
    public function test(self&A $x) {}
}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "A", expecting variable in Standard input code on line 4
===php_error 8.1-8.4===
PHP Fatal error:  Type self cannot be part of an intersection type in Standard input code on line 4
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "TestSelfIntersection",
            "span": {
              "start": 70,
              "end": 90
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
                    "name": "test",
                    "span": {
                      "start": 113,
                      "end": 117
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 125,
                          "end": 127
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "self"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 118,
                                    "end": 122
                                  }
                                }
                              },
                              "span": {
                                "start": 118,
                                "end": 122
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
                                    "start": 123,
                                    "end": 124
                                  }
                                }
                              },
                              "span": {
                                "start": 123,
                                "end": 124
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 118,
                          "end": 124
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 118,
                        "end": 127
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 97,
                "end": 131
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}
