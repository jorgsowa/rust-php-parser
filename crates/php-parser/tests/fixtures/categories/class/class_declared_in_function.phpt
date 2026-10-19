===source===
<?php
function f() {
    class A {
        public function g() {
            function h() {
                class B {}
                interface I {}
            }
            return new class {};
        }
    }
}
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Class": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 31,
                      "end": 32
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
                            "name": "g",
                            "span": {
                              "start": 59,
                              "end": 60
                            }
                          },
                          "modifiers": {
                            "visibility": "Public"
                          },
                          "by_ref": false,
                          "params": [],
                          "return_type": null,
                          "body": [
                            {
                              "kind": {
                                "Function": {
                                  "name": {
                                    "name": "h",
                                    "span": {
                                      "start": 86,
                                      "end": 87
                                    }
                                  },
                                  "params": [],
                                  "body": [
                                    {
                                      "kind": {
                                        "Class": {
                                          "name": {
                                            "name": "B",
                                            "span": {
                                              "start": 114,
                                              "end": 115
                                            }
                                          },
                                          "modifiers": {
                                            "is_abstract": false,
                                            "is_final": false,
                                            "is_readonly": false
                                          },
                                          "extends": null,
                                          "implements": [],
                                          "members": [],
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 108,
                                        "end": 118
                                      }
                                    },
                                    {
                                      "kind": {
                                        "Interface": {
                                          "name": {
                                            "name": "I",
                                            "span": {
                                              "start": 145,
                                              "end": 146
                                            }
                                          },
                                          "extends": [],
                                          "members": [],
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 135,
                                        "end": 149
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "by_ref": false,
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 77,
                                "end": 163
                              }
                            },
                            {
                              "kind": {
                                "Return": {
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
                                            "members": [],
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 183,
                                          "end": 195
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 183,
                                    "end": 195
                                  }
                                }
                              },
                              "span": {
                                "start": 176,
                                "end": 196
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 206
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 25,
                "end": 212
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 214
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 214
  }
}
