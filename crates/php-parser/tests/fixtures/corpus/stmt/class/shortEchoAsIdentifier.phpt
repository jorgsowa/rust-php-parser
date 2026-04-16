===source===
<?php
class C {
    use T {
        x as y?><?= as my_echo;
    }
}
===errors===
expected ';', found '?>'
expected identifier, found '?>'
expected '::' or 'as', found '?>'
expected identifier, found '<?php'
expected '::' or 'as', found '<?php'
expected '::' or 'as', found identifier
expected identifier, found ';'
expected '::' or 'as', found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "C",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "name": "x",
                            "span": {
                              "start": 36,
                              "end": 37
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "name": "y",
                            "span": {
                              "start": 41,
                              "end": 42
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 42
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 65
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
===php_error===
PHP Parse error:  Cannot use "<?=" as an identifier in Standard input code on line 4
