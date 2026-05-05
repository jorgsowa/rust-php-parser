===config===
min_php=8.3
===source===
<?php
interface Logger {
    public function log(string $msg): void;
    @invalid
    public function error(string $msg): void;
}
===errors===
expected class member, found '@'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "Logger",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "log",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "msg",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 49,
                              "end": 55
                            }
                          }
                        },
                        "span": {
                          "start": 49,
                          "end": 55
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
                        "start": 49,
                        "end": 60
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 63,
                          "end": 67
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 67
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 68
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "error",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "msg",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 108,
                              "end": 114
                            }
                          }
                        },
                        "span": {
                          "start": 108,
                          "end": 114
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
                        "start": 108,
                        "end": 119
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 122,
                          "end": 126
                        }
                      }
                    },
                    "span": {
                      "start": 122,
                      "end": 126
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 86,
                "end": 127
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 129
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 129
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 4
