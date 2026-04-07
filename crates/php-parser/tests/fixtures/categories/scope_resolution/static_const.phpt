===source===
<?php class Foo { public function f() { return static::DEFAULT; } }
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
                        "Return": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Identifier": "static"
                                },
                                "span": {
                                  "start": 47,
                                  "end": 53
                                }
                              },
                              "member": "DEFAULT"
                            }
                          },
                          "span": {
                            "start": 47,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 64
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
