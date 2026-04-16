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
                            "end": 66
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 67
                      }
                    },
                    {
                      "kind": "Error",
                      "span": {
                        "start": 73,
                        "end": 79
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
                                    "end": 117
                                  }
                                }
                              },
                              "span": {
                                "start": 109,
                                "end": 118
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
                        "end": 124
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 126
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 126
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "public" in Standard input code on line 7
