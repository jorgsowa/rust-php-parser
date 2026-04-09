===source===
<?php
class Foo {
    public function bar()
    {
        return 1;

    public function baz()
    {
        return 2;
    }
}
===errors===
expected expression
expected '}', found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 65,
                            "end": 66,
                            "start_line": 5,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 73,
                        "start_line": 5,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": "Error",
                      "span": {
                        "start": 73,
                        "end": 80,
                        "start_line": 7,
                        "start_col": 4
                      }
                    },
                    {
                      "kind": {
                        "Function": {
                          "name": "baz",
                          "params": [],
                          "body": [
                            {
                              "kind": {
                                "Return": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 116,
                                    "end": 117,
                                    "start_line": 9,
                                    "start_col": 15
                                  }
                                }
                              },
                              "span": {
                                "start": 109,
                                "end": 123,
                                "start_line": 9,
                                "start_col": 8
                              }
                            }
                          ],
                          "return_type": null,
                          "by_ref": false,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 124,
                        "start_line": 7,
                        "start_col": 11
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 126,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 126,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126,
    "start_line": 1,
    "start_col": 0
  }
}
