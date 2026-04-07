===source===
<?php class Foo { public static function create() { return new static(); } }
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
                  "name": "create",
                  "visibility": "Public",
                  "is_static": true,
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
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "static"
                                },
                                "span": {
                                  "start": 63,
                                  "end": 69
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 71
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 73
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 75
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 76
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}
