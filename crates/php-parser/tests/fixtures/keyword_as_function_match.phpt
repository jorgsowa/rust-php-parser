===source===
<?php function match() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "match",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "match", expecting "(" in Standard input code on line 1
