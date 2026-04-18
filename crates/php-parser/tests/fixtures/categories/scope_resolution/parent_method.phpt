===source===
<?php class Foo extends Bar { public function f() { parent::f(); } }
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
          "extends": {
            "parts": [
              "Bar"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 24,
              "end": 27
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "f",
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
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Identifier": "parent"
                                },
                                "span": {
                                  "start": 52,
                                  "end": 58
                                }
                              },
                              "method": {
                                "parts": [
                                  "f"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 60,
                                  "end": 61
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 52,
                            "end": 63
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 64
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
