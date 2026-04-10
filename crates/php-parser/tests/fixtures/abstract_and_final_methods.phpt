===source===
<?php
abstract class Base {
    abstract protected function template(): string;
    final public function execute(): void {
        echo $this->template();
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Base",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "template",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 72,
                          "end": 78
                        }
                      }
                    },
                    "span": {
                      "start": 72,
                      "end": 78
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 79
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "execute",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 117,
                          "end": 121
                        }
                      }
                    },
                    "span": {
                      "start": 117,
                      "end": 121
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "MethodCall": {
                                "object": {
                                  "kind": {
                                    "Variable": "this"
                                  },
                                  "span": {
                                    "start": 137,
                                    "end": 142
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "template"
                                  },
                                  "span": {
                                    "start": 144,
                                    "end": 152
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 137,
                              "end": 154
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 132,
                        "end": 155
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 84,
                "end": 161
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}
