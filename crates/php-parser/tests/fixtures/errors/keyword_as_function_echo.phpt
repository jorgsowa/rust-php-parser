===source===
<?php function echo() {}
===errors===
cannot use 'echo' as function name; it is reserved
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "echo",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "echo", expecting "(" in Standard input code on line 1
