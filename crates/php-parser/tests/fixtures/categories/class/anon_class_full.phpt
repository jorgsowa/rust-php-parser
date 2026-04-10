===source===
<?php $obj = new class(1) extends Base implements Iface1, Iface2 { public function run() {} };
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
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10
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
                          "extends": {
                            "parts": [
                              "Base"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 34,
                              "end": 38
                            }
                          },
                          "implements": [
                            {
                              "parts": [
                                "Iface1"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 50,
                                "end": 56
                              }
                            },
                            {
                              "parts": [
                                "Iface2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 58,
                                "end": 64
                              }
                            }
                          ],
                          "members": [
                            {
                              "kind": {
                                "Method": {
                                  "name": "run",
                                  "visibility": "Public",
                                  "is_static": false,
                                  "is_abstract": false,
                                  "is_final": false,
                                  "by_ref": false,
                                  "params": [],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 67,
                                "end": 92
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 93
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 23,
                            "end": 24
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 23,
                          "end": 24
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 13,
                  "end": 93
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 93
          }
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
