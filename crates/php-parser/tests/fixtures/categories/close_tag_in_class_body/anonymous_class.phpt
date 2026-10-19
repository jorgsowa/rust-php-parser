===source===
<?php $o = new class { public $p ?><?php };
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                "Property": {
                                  "name": {
                                    "name": "p",
                                    "span": {
                                      "start": 30,
                                      "end": 32
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Public"
                                  },
                                  "type_hint": null,
                                  "default": null,
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 23,
                                "end": 32
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 42
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
