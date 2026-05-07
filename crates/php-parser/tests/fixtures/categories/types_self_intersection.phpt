===config===
min_php=8.5

===source===
<?php
// Self in intersection type — valid only from PHP 8.5+
class TestSelfIntersection {
    public function test(self&A $x) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "TestSelfIntersection",
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
                  "name": "test",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
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
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
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
